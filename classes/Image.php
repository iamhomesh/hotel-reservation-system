<?php

trait Image
{
    public function getExtension(array $file, string $fieldName): string
    {
        switch ($file[$fieldName]['type']) {
            case "image/pjpeg":
            case "image/jpeg":
                $extension = "jpg";
                break;
            case "image/png":
                $extension = "png";
                break;
            default:
                $extension = "";
                break;
        }
        return $extension;
    }
}