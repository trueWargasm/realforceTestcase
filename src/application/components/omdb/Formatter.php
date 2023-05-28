<?php

namespace application\components\omdb;

class Formatter
{
    public static function prepareOmdbSingle(array $row)
    {
        return [
            'ID' => $row['imdbID'],
            'dataType' => $row['Type'],
            'name'  => $row['Title'],
            'description' => $row['Plot'],
            'photoUrl' => $row['Poster']
        ];
    }

    public static function prepareOmdbListItem(array $row)
    {
        return [
            'ID' => $row['imdbID'],
            'dataType' => $row['Type'],
            'name'  => $row['Title'],
            'description' => '',
            'photoUrl' => $row['Poster']
        ];
    }

    public static function prepareJsonListItem(array $row)
    {
        return [
            'ID' => $row['id'],
            'dataType' => 'driver',
            'name'  => $row['name'],
            'description' => $row['bio'],
            'photoUrl' => $row['image']
        ];
    }
}
