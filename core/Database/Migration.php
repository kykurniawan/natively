<?php

namespace Core\Database;

interface Migration
{
    public function up();
    public function down();
}
