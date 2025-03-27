<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailSettingRequest;
use App\Models\EmailSetting;
use Illuminate\Http\Request;

class EmailSettingController extends Controller
{
    public function store(EmailSettingRequest $request)
    {
        EmailSetting::create($request->validated());
        return response(['message' => 'Email setting created successfully.'], 201);
    }
}
