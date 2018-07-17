<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Console\ShellDispatcher;
use Cake\Datasource\ConnectionManager;

/**
 * Rbac shell command.
 */
class RbacShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->setDescription('This is RBAC utility, which wraps acl cli');
        // $parser->addArgument('add_rule',[
        //     'help' => 'Add hierachical rules to acos table',
        // ]);

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    public function initialize()
    {
        parent::initialize();
    }

    public function up(){
        $this->out('Setting up default rules...');
        $shell = new ShellDispatcher();
        $shell->run(['cake', 'acl_extras', 'aco_sync']);
        $conn = ConnectionManager::get('default');
        $aro = $conn->execute("SELECT * FROM aros WHERE parent_id IS NULL AND model = 'groups'")->fetch(\PDO::FETCH_ASSOC);
        $aco = $conn->execute("SELECT * FROM acos WHERE alias = 'Admin'")->fetch(\PDO::FETCH_ASSOC);
    
        $targetPermissions = $conn
            ->execute("SELECT * FROM acos WHERE lft > :left AND rght < :right",['left'=>$aco['lft'],'right'=>$aco['rght']])
            ->fetchAll(\PDO::FETCH_ASSOC);

        $ids = array_map(function($item){return $item['id'];},$targetPermissions);
        $ids[] = $aco['id'];

        $otherPermissions = $conn
            ->execute("SELECT * FROM acos WHERE id NOT IN (".implode(',',$ids).")")
            ->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach($targetPermissions as $permission){
            $shell->run(['cake','acl','grant',$aro['id'],$permission['id']]);
        }

        foreach($otherPermissions as $otherPermission){
            $shell->run(['cake', 'acl', 'deny', $aro['id'], $otherPermission['id']]);
        }

        $this->out('Settings permissions done.');
    }

    public function sync(){
        $this->out('Start updating rules in acos table...');
        $shell = new ShellDispatcher();
        $shell->run(['cake', 'acl_extras', 'aco_update']);
        $this->out('Done');
    }

    public function addRule($parent=null,$child=null){
        if($parent === null){
            $this->abort("parent argument is required");
        }
        if($child === null){
            $this->abort('child argument is required');
        }
        $shell = new ShellDispatcher();
        $output = $shell->run(['cake', 'acl', 'create', 'aco', $parent, $child]);
        
        $this->out($output);
    }
}
