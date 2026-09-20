@extends('errors.layout', [
    'code' => 404,
    'icon' => 'search',
    'title' => __('site::messages.error_404_title'),
    'message' => __('site::messages.error_404_message'),
])
