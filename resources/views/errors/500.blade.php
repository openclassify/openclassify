@extends('errors.layout', [
    'code' => 500,
    'icon' => 'shield',
    'title' => __('site::messages.error_500_title'),
    'message' => __('site::messages.error_500_message'),
])
