<?php

use Intervention\Image\Facades\Image;

function notification($message, $alertType)
{
    $notification = [
        'message' => $message,
        'type' => $alertType,
    ];

    return $notification;
}

function uploadAndResizeImage($file, $destinationPath, $width, $height)
{
    $timestamp = now()->format('Y-m-d-H-i-s');
    $extension = $file->getClientOriginalExtension();
    $filename = $timestamp . '.' . $extension;
    $file->move(public_path($destinationPath), $filename);
    $resizedImage = Image::make(public_path($destinationPath . '/' . $filename))->resize($width, $height);
    $resizedImage->save();
    return $destinationPath . '/' . $filename;
}


function generateInvoiceNumber()
{
    $prefix = 'INV';
    $timestamp = now()->format('YmdHis');
    $randomDigits = mt_rand(1000, 9999);

    return $prefix . $timestamp . $randomDigits;
}

