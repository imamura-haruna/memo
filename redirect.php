<?php

/**
 * リダイレクト用の関数
 * 
 * @param string $path リダイレクト先のパス
 */
function redirect(string $path): void
{
    header('Location: ' . $path);
    die;
}
