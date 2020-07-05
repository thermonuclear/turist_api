<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;

/*
 * Переопределение папки для eloquent моделей
 *
 */
class AppMakeModel extends ModelMakeCommand
{
    /**
     * Prefix default root namepsace with a folder.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\EloquentModels';
    }
}
