<?php

class Add_password_to_users_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->table_exists('users')) {
            return;
        }

        if ($this->_lava->dbforge->column_exists('users', 'password')) {
            return;
        }

        $this->_lava->dbforge->add_column('users', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE,
                'after'      => 'email',
            ],
        ]);
    }

    public function down()
    {
        if ($this->_lava->dbforge->column_exists('users', 'password')) {
            $this->_lava->dbforge->drop_column('users', 'password');
        }
    }
}
