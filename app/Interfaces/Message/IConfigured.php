<?php

namespace App\Interfaces\Message;

use App\Models\ConfigMessage;

interface IConfigured
{
    public function help(): string;
    public function defaultText(): string;
    public function defaultConfig(): ConfigMessage;
    public function alias(): string;
    public function translate(): string;
}
