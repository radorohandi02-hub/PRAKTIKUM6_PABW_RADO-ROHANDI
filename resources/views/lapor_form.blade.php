<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>LaporBanjir — Form Pelaporan</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: Georgia, 'Times New Roman', serif;
        background: #f4f1ea;
        color: #1a1a1a;
        padding: 40px 20px;
    }

    .wrap {
        max-width: 560px;
        margin: 0 auto;
    }

    .masthead {
        border-top: 4px solid #8b2020;
        border-bottom: 1px solid #1a1a1a;
        padding: 14px 0 10px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .masthead .agency {
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-family: Arial, sans-serif;
        color: #555;
    }

    .masthead .title {
        font-size: 22px;
        font-weight: bold;
    }

    .lead {
        font-family: Arial, sans-serif;
        font-size: 13px;
        color: #444;
        line-height: 1.6;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid #d8d2c4;
    }

    form {
        background: #fff;
        border: 1px solid #d8d2c4;
    }

    .field {
        padding: 16px 20px;
        border-bottom: 1px solid #e4e0d5;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .field:last-of-type { border-bottom: none; }

    .field .num {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #8b2020;
        font-weight: bold;
        width: 16px;
        flex-shrink: 0;
    }

    .field .col {
        flex: 1;
    }

    .field label {
        display: block;
        font-family: Arial, sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #777;
        margin-bottom: 6px;
    }

    .field input {
        width: 100%;
        border: none;
        border-bottom: 1px solid #c9c2b0;
        padding: 6px 0;
        font-family: Georgia, serif;
        font-size: 16px;
        background: transparent;
        outline: none;
    }

    .field input:focus {
        border-bottom: 1px solid #8b2020;
    }

    .submit-row {
        padding: 18px 20px;
        background: #efeadf;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: Arial, sans-serif;
    }

    .submit-row .hint {
        font-size: 11px;
        color: #888;
    }

    button {
        background: #8b2020;
        color: #fff;
        border: none;
        padding: 10px 22px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        cursor: pointer;
    }

    button:hover { background: #6e1919; }
</style>
</head>
<body>
<div class="wrap">
    <div class="masthead">
        <div>
            <div class="agency">BPBD Kabupaten Bandung</div>
            <div class="title">LaporBanjir</div>
        </div>
    </div>

    <p class="lead">
        Formulir ini digunakan untuk melaporkan kejadian banjir di wilayah Anda.
        Data yang dikirim akan diproses dan ditampilkan sebagai konfirmasi,
        tidak disimpan secara permanen ke dalam basis data.
    </p>

    <form action="{{ route('lapor.proses') }}" method="POST" onsubmit="return validasiForm()">
        @csrf

        <div class="field">
            <div class="num">01</div>
            <div class="col">
                <label for="nama">Nama Pelapor</label>
                <input type="text" name="nama" id="nama" required>
            </div>
        </div>

        <div class="field">
            <div class="num">02</div>
            <div class="col">
                <label for="lokasi">Lokasi Kejadian — Kecamatan / Desa</label>
                <input type="text" name="lokasi" id="lokasi" required>
            </div>
        </div>

        <div class="field">
            <div class="num">03</div>
            <div class="col">
                <label for="tinggi_air">Tinggi Genangan Air (cm)</label>
                <input type="number" name="tinggi_air" id="tinggi_air" min="0" required>
            </div>
        </div>

        <div class="submit-row">
            <span class="hint">Periksa data sebelum mengirim</span>
            <button type="submit">Kirim Laporan</button>
        </div>
    </form>
</div>

<script>
    function validasiForm() {
        const tinggi = document.getElementById('tinggi_air').value;