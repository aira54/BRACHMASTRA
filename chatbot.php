<?php
header("Content-Type: application/json");

// Ambil pesan user
$input = json_decode(file_get_contents("php://input"), true);
$userMessage = isset($input["message"]) ? trim($input["message"]) : "";

// Respon FAQ tetap (prioritas utama)
$responses = [
    "halo","hai" => "Halo, selamat datang di Brachmastra! Ada yang bisa kami bantu?",
    "jam buka" => "Jam operasional kantor: Senin - Jumat, 08:00 - 16:00 WIB. Namun, chatbot siap membantu 24 jam 😊",
    "lokasi" => "Kantor kami berlokasi di Jl. Contoh No.123, Jakarta.",
    "kontak" => "Hubungi kami via WhatsApp 0812-3456-7890 atau email info@brachmastra.com.",
    "layanan" => "Kami menyediakan layanan konsultasi hukum: Pidana, Perdata, Keluarga, Bisnis, dan lainnya.",
    "daftar konsultasi" => "Untuk daftar konsultasi, silakan klik menu 'Konsultasi' di website kami.",

    // Tambahan FAQ umum konsultasi virtual
    "biaya konsultasi","biaya" => "Biaya konsultasi bervariasi, mulai dari gratis untuk pertanyaan dasar, hingga berbayar untuk konsultasi mendalam dengan pengacara. Silakan pilih paket di menu 'Konsultasi'.",
    "cara konsultasi","cara" => "Konsultasi bisa dilakukan secara online melalui WhatsApp, Zoom, atau Google Meet sesuai kenyamanan Anda.",
    "durasi konsultasi","durasi" => "Durasi konsultasi biasanya 30-60 menit, tergantung kompleksitas masalah hukum.",
    "keamanan data" => "Data dan percakapan Anda dijamin kerahasiaannya, sesuai dengan kode etik advokat dan kebijakan privasi Brachmastra.",
    "jenis konsultasi" => "Kami menyediakan konsultasi hukum gratis untuk pertanyaan singkat, dan berbayar untuk pendampingan atau kasus kompleks.",
    "jadwal konsultasi" => "Anda bisa memilih jadwal konsultasi sesuai ketersediaan pengacara. Silakan atur jadwal melalui menu 'Konsultasi'.",
    "media konsultasi" => "Konsultasi dapat dilakukan melalui WhatsApp, telepon, Zoom, atau Google Meet.",
    "konsultasi virtual" => "Konsultasi hukum virtual memudahkan Anda mendapat bantuan hukum tanpa harus datang ke kantor. Cukup daftar, pilih pengacara, lalu lakukan konsultasi via online."
    
];

$reply = null;
foreach ($responses as $key => $value) {
    if (stripos($userMessage, $key) !== false) {
        $reply = $value;
        break;
    }
}


// Jika tidak ada jawaban di FAQ → pakai AI
if (!$reply) {
   $apiKey = getenv('OPENAI_API_KEY');

    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);

    $postData = [
        "model" => "gpt-3.0", // bisa ganti gpt-4 kalau ada akses
        "messages" => [
            [
                "role" => "system",
                "content" => "Kamu adalah Chat CS Brachmastra. 
                Jawablah pertanyaan hukum dengan bahasa yang jelas, ringkas, edukatif, dan ramah. 
                Fokus pada hukum di Indonesia. 
                Utamakan memberi penjelasan mengenai:
                - Hukum pidana (contoh: pencurian, penganiayaan, korupsi).
                - Hukum perdata (contoh: perjanjian, hutang-piutang, warisan).
                - Hukum keluarga (contoh: perkawinan, perceraian, hak asuh anak).
                - Hukum bisnis (contoh: kontrak usaha, perusahaan, sengketa komersial).
                - Konsultasi hukum virtual (biaya, cara, media, keamanan).
                Jelaskan juga perbedaan antar bidang hukum bila ditanya.
                Jika pengguna bertanya kasus pribadi, jawab secara umum lalu arahkan untuk konsultasi dengan pengacara Brachmastra."
            ],
            ["role" => "user", "content" => $userMessage]
        ],
        "max_tokens" => 500,
        "temperature" => 0.4
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $reply = $result["choices"][0]["message"]["content"]
        ?? "Saya bisa membantu menjelaskan hukum umum (pidana, perdata, keluarga, bisnis, konsultasi virtual). Untuk kasus pribadi, silakan gunakan layanan konsultasi pengacara.";
}

// Kirim balasan JSON
echo json_encode(["reply" => $reply]);
