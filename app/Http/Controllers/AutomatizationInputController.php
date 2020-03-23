<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableContent;

class AutomatizationInputController extends Controller
{
    
    public function automate(){
        $automateArray = [];

        $title = new TableContent('string', 'name', 'Naziv', 'text', null);
        $contentArray = [];
        $contentArray[] = $title;
        $arrNewsCategory = ['model_name' => 'NewsCategory', 'table_name' => 'news_categories', 'attributes' => $contentArray];
        array_push($automateArray, $arrNewsCategory);

        // $author = new TableContent('string', 'author', 'Autor', 'text', null);
        // $title = new TableContent('string', 'title', 'Naslov', 'text', null);
        // $shortDescription = new TableContent('text', 'short_description', 'Kratak opis', 'textarea', null);
        // $content = new TableContent('text', 'content', 'Sadržaj', 'textarea', null);
        // $status = new TableContent('string', 'status', 'Status', 'text', null);
        // $image = new TableContent('text', 'image', 'Slika', 'file', ['type' => 'image']);
        // $timestamp = new TableContent('datetime', 'datetime', 'Datum', 'datetime', null);
        // $contentArray = [$author, $title, $shortDescription, $content, $status, $image, $timestamp];
        // $arrNews = ['model_name' => 'News', 'table_name' => 'news', 'attributes' => $contentArray];
        // array_push($automateArray, $arrNews);

        // $name = new TableContent('string', 'name', 'Naziv', 'text', null);
        // $timestamp = new TableContent('datetime', 'datetime', 'Datum', 'datetime', null);
        // $contentArray = [$name, $timestamp];
        // $arrAlbumCategory = ['model_name' => 'AlbumCategory', 'table_name' => 'album_categories', 'attributes' => $contentArray];
        // array_push($automateArray, $arrAlbumCategory);

        // $title = new TableContent('string', 'title', 'Naziv', 'text', null);
        // $shortDescription = new TableContent('string', 'short_description', 'Kratak opis', 'text', null);
        // $image = new TableContent('text', 'image', 'Slika', 'file', ['type' => 'image']);
        // $contentArray = [$title, $shortDescription, $image];
        // $arrAlbum = ['model_name' => 'Album', 'table_name' => 'albums', 'attributes' => $contentArray];
        // array_push($automateArray, $arrAlbum);

        // $image = new TableContent('text', 'image', 'Slika', 'file', ['type' => 'image']);
        // $contentArray = [];
        // $contentArray[] = $image;
        // $arrAlbumImage = ['model_name' => 'AlbumImage', 'table_name' => 'album_images', 'attributes' => $contentArray];
        // array_push($automateArray, $arrAlbumImage);

        // $name = new TableContent('string', 'name', 'Ime', 'text', null);
        // $surname = new TableContent('string', 'surname', 'Prezime', 'text', null);
        // $position = new TableContent('string', 'position', 'Pozicija', 'text', null);
        // $number = new TableContent('integer', 'number', 'Broj', 'number', null);
        // $date = new TableContent('date', 'date', 'Datum rođenja', 'date', null);
        // $birthPlace = new TableContent('string', 'birth_place', 'Mjesto rođenja', 'text', null);
        // $bio = new TableContent('text', 'bio', 'Biografija', 'textarea', null);
        // $height = new TableContent('double', 'height', 'Visina', 'number', null);
        // $weight = new TableContent('double', 'weight', 'Težina', 'number', null);
        // $profileImage = new TableContent('text', 'profile_image', 'Profilna slika', 'file', ['type' => 'image']);
        // $ballImage = new TableContent('text', 'ball_image', 'Slika sa loptom', 'file', ['type' => 'image']);
        // $signatureImage = new TableContent('text', 'signature_image', 'Slika sa potpisom', 'file', ['type' => 'image']);
        // $dressImage = new TableContent('text', 'dress_image', 'Dres', 'file', ['type' => 'image']);
        // $contentArray = [$name, $surname, $position, $number, $date, $birthPlace, $bio, $height, $weight, $profileImage, $ballImage, $signatureImage, $dressImage];
        // $arrPlayer = ['model_name' => 'Player', 'table_name' => 'players', 'attributes' => $contentArray];
        // array_push($automateArray, $arrPlayer);

        // $name = new TableContent('string', 'name', 'Liga', 'text', null);
        // $date = new TableContent('date', 'date', 'Godina', 'date', null);
        // $contentArray = [$name, $date];
        // $arrLeague = ['model_name' => 'League', 'table_name' => 'leagues', 'attributes' => $contentArray];
        // array_push($automateArray, $arrLeague);

        // $name = new TableContent('string', 'name', 'Sezona', 'text', null);
        // $contentArray = [];
        // $contentArray[] = $title;
        // $arrSeason = ['model_name' => 'Season', 'table_name' => 'seasons', 'attributes' => $contentArray];
        // array_push($automateArray, $arrSeason);

        // $content = new TableContent('text', 'content', 'Sadržaj', 'textarea', null);
        // $contentArray = [];
        // $contentArray[] = $content;
        // $arrHistory = ['model_name' => 'History', 'table_name' => 'histories', 'attributes' => $contentArray];
        // array_push($automateArray, $arrHistory);

        // $author = new TableContent('string', 'author', 'Autor', 'text', null);
        // $title = new TableContent('string', 'title', 'Naslov', 'text', null);
        // $shortDescription = new TableContent('text', 'short_description', 'Kratak opis', 'textarea', null);
        // $content = new TableContent('text', 'content', 'Sadržaj', 'textarea', null);
        // $status = new TableContent('string', 'status', 'Status', 'text', null);
        // $image = new TableContent('text', 'image', 'Slika', 'file', ['type' => 'image']);
        // $timestamp = new TableContent('datetime', 'datetime', 'Datum', 'datetime', null);
        // $contentArray = [$author, $title, $shortDescription, $content, $status, $image, $timestamp];
        // $arrBlogs = ['model_name' => 'Blog', 'table_name' => 'blogs', 'attributes' => $contentArray];
        // array_push($automateArray, $arrBlogs);

        // $name = new TableContent('string', 'name', 'Ime', 'text', null);
        // $surname = new TableContent('string', 'surname', 'Prezime', 'text', null);
        // $position = new TableContent('string', 'position', 'Pozicija', 'text', null);
        // $category = new TableContent('string', 'category', 'Kategorija', 'text', null);
        // $profileImage = new TableContent('text', 'profile_image', 'Profilna slika', 'file', ['type' => 'image']);
        // $noBgImage = new TableContent('text', 'image', 'Slika bez pozadine', 'file', ['type' => 'image']);
        // $contentArray = [$name, $surname, $position, $category, $profileImage, $noBgImage];
        // $arrManagers = ['model_name' => 'Manager', 'table_name' => 'managers', 'attributes' => $contentArray];
        // array_push($automateArray, $arrManagers);

        // $host = new TableContent('string', 'host', 'Domaćin', 'text', null);
        // $guest = new TableContent('string', 'guest', 'Gost', 'text', null);
        // $timestamp = new TableContent('datetime', 'datetime', 'Datum', 'datetime', null);
        // $arena = new TableContent('string', 'arena', 'Hala', 'text', null);
        // $city = new TableContent('string', 'city', 'Grad', 'text', null);
        // $hostImage = new TableContent('text', 'host_image', 'Logo domaćia', 'file', ['type' => 'image']);
        // $guestImage = new TableContent('text', 'guest_image', 'Logo gosta', 'file', ['type' => 'image']);
        // $contentArray = [$host, $guest, $timestamp, $arena, $city, $hostImage, $guestImage];
        // $arrMatch = ['model_name' => 'Match', 'table_name' => 'matches', 'attributes' => $contentArray];
        // array_push($automateArray, $arrMatch);

        // $name = new TableContent('string', 'name', 'Ime', 'text', null);
        // $image = new TableContent('text', 'image', 'Logo', 'file', ['type' => 'image']);
        // $noMatches = new TableContent('integer', 'no_matches', 'Broj utakmica', 'number', null);
        // $noVictory = new TableContent('integer', 'no_wins', 'pobjede', 'number', null);
        // $noDraw = new TableContent('integer', 'no_draw', 'Neriješeno', 'number', null);
        // $noLost = new TableContent('integer', 'no_lost', 'Porazi', 'number', null);
        // $noGoals = new TableContent('integer', 'no_scored_goals', 'Postignuti golovi', 'number', null);
        // $noReceived = new TableContent('integer', 'no_received_goals', 'Primljeni golovi', 'number', null);
        // $difference = new TableContent('integer', 'difference', 'Gol razlika', 'number', null);
        // $points = new TableContent('integer', 'points', 'Bodovi', 'number', null);
        // $contentArray = [$name, $image, $noMatches, $noVictory, $noDraw, $noLost, $noGoals, $noReceived, $difference, $points];
        // $arrTable = ['model_name' => 'Table', 'table_name' => 'tables', 'attributes' => $contentArray];
        // array_push($automateArray, $arrTable);

        $testController = new GeneratorController();

        // print_r($automateArray);
        // print_r($automateArray[12]['attributes'][5]);
        for($i = 0; $i < count($automateArray); $i++){
            $testController->generate($automateArray[$i]);
        }
    }

}
