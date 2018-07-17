<?php
use Migrations\AbstractMigration;

class DropDesirableAndundesirableColumnsFromApplicants extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('applicants');
        $table->removeColumn('desirable_countries');
        $table->removeColumn('undesirable_countries');
        $table->update();
    }
}
