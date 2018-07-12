<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <?= $this->Html->link(__('Админ панель'), ['prefix'=>'admin', 'controller'=>'default', 'action'=>'index'], ['class'=>'navbar-brand']) ?>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="/"><i class="fa fa-home fa-fw"></i> Website</a></li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?= $this->request->getSession()->read('Auth.User.username') ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <!-- <li class="divider"></li> -->
                <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <?= $this->Html->link('<i class="fa fa-sitemap fa-fw"></i> Управление правами доступа', ['controller' => 'Acl','action' => 'index'],['escape' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-users fa-fw"></i> Пользователи', ['controller' => 'Users','action' => 'index'],['escape' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-users fa-fw"></i> Группы', ['controller' => 'Groups','action' => 'index'],['escape' => false]) ?>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-table fa-fw"></i> 
                        Справочники 
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <?= $this->Html->link('Страны', ['controller' => 'DictionaryCountries','action' => 'index'],['escape' => false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Области', ['controller' => 'DictionaryRegions','action' => 'index'],['escape' => false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Районы', ['controller' => 'DictionaryDistricts','action' => 'index'],['escape' => false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Отрасли', ['controller' => 'DictionaryIndustries','action' => 'index'],['escape' => false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Уровень образование', ['controller' => 'DictionaryEducationLevels','action' => 'index'],['escape' => false]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>