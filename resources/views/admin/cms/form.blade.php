@extends('layouts.admin')
@section('title',($item->exists ? 'Edit ' : 'New ').$config['singular'])
@section('page_heading',($item->exists ? 'Edit ' : 'New ').$config['singular'])
@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.cms.update',[$resource,$item->id]) : route('admin.cms.store',$resource) }}">@csrf @if($item->exists)@method('PUT')@endif
<div class="admin-form-grid"><section class="admin-card form-card"><div class="admin-card-head"><div><h3>{{ $item->exists ? 'Edit content' : 'Create content' }}</h3><p>Fields marked by the browser as required must be completed.</p></div></div><div class="admin-form">
@foreach($config['fields'] as $name => $field)
    @php($value = old($name, $item->{$name}))
    @if($field['type'] === 'checkbox')
        <label class="check-field panel-check"><input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $item->{$name}))><span><strong>{{ $field['label'] }}</strong><small>Enable this option</small></span></label>
    @elseif($field['type'] === 'textarea')
        <label>{{ $field['label'] }}<textarea name="{{ $name }}" rows="{{ in_array($name,['body','quote','bio']) ? 10 : 4 }}">{{ $value }}</textarea>@error($name)<small class="field-error">{{ $message }}</small>@enderror</label>
    @elseif($field['type'] === 'image')
        <label>{{ $field['label'] }}@if($item->{$name})<span class="current-file"><img src="{{ asset('storage/'.$item->{$name}) }}" alt="" width="90" height="70">Current image</span>@endif<input type="file" name="{{ $name }}" accept="image/jpeg,image/png,image/webp,image/avif">@error($name)<small class="field-error">{{ $message }}</small>@enderror</label>
    @else
        @php
            $inputValue = $value;
            if ($field['type'] === 'date' && $item->{$name} instanceof \Carbon\CarbonInterface) $inputValue = $item->{$name}->format('Y-m-d');
            if ($field['type'] === 'datetime-local' && $item->{$name} instanceof \Carbon\CarbonInterface) $inputValue = $item->{$name}->format('Y-m-d\TH:i');
        @endphp
        <label>{{ $field['label'] }}<input type="{{ $field['type'] }}" name="{{ $name }}" value="{{ $inputValue }}">@error($name)<small class="field-error">{{ $message }}</small>@enderror</label>
    @endif
@endforeach
</div></section><aside class="admin-card form-actions-card"><span class="admin-kicker">Publishing</span><h3>{{ $item->exists ? 'Save your changes' : 'Ready to create?' }}</h3><p>Content becomes available to the public site according to its Active/Publish options.</p><button class="admin-btn full-btn" type="submit">{{ $item->exists ? 'Save changes' : 'Create '.$config['singular'] }}</button><a class="secondary-btn full-btn" href="{{ route('admin.cms.index',$resource) }}">Cancel</a></aside></div></form>
@endsection
