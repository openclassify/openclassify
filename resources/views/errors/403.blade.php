@extends('errors.layout', [
    'code' => 403,
    'icon' => 'shield',
    'title' => __('site::messages.error_403_title'),
    'message' => __('site::messages.error_403_message'),
])
