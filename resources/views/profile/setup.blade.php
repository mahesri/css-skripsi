@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Lengkapi Profilmu</h2>

    <p>Hallo, {{ $userName ?? 'User' }}</p>

<form action="{{ route('profile.store') }}" method="post">

    @csrf
    <div class="mb-3">
        <label for="skills" class="">Skills (Pisahkan dengan koma) :</label>
        <input type="text" name="skills" id="" placeholder="contoh: accounting, excel, tax" required>

    </div>

    <div class="mb-3">
        <label for="years_experience" class="">Pengalaman (Tahun) :</label>
        <input type="number" name="years_experience" id="years_experience" min="0" required>
    </div>

    <div class="mb-3">
        <label for="preference" class="form-label">Preferensi</label>
        <select name="preference">
            <option>---Pilih---</option>
            <option value="gaji">Gaji Tinggi</option>
            <option value="wlb">Work Life Balence</option>
            <option value="growth">Kesempatan Belajar</option>
        </select>

    </div>

    <button type="submit">Dapatkan rekomendasi</button>
</form>
</div>

