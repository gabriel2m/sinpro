@extends('layouts.error')

@php($title[] = __('Method Not Allowed'))
@section('code', '405')
@section('message', __('Method Not Allowed'))
