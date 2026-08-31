<?php

$dir = __DIR__ . '/../public/images';
$backupDir = __DIR__ . '/../public/images/originals_backup';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

function processImage($filename, $maxW, $maxH, $quality) {
    global $dir, $backupDir;
    $filePath = $dir . '/' . $filename;
    if (!file_exists($filePath)) return;

    $backupPath = $backupDir . '/' . $filename;
    if (!file_exists($backupPath)) {
        copy($filePath, $backupPath);
    }

    $info = getimagesize($filePath);
    if (!$info) return;

    $origW = $info[0];
    $origH = $info[1];
    $mime = $info['mime'];

    // Calculate scale
    $scale = min($maxW / $origW, $maxH / $origH, 1.0);
    $targetW = max(1, (int)round($origW * $scale));
    $targetH = max(1, (int)round($origH * $scale));

    $srcImg = null;
    if ($mime === 'image/jpeg') {
        $srcImg = imagecreatefromjpeg($backupPath);
    } elseif ($mime === 'image/png') {
        $srcImg = imagecreatefrompng($backupPath);
    }

    if (!$srcImg) return;

    $dstImg = imagecreatetruecolor($targetW, $targetH);
    if ($mime === 'image/png') {
        imagealphablending($dstImg, false);
        imagesavealpha($dstImg, true);
        $transparent = imagecolorallocatealpha($dstImg, 255, 255, 255, 127);
        imagefilledrectangle($dstImg, 0, 0, $targetW, $targetH, $transparent);
    }

    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

    // Save as WebP
    $webpPath = $dir . '/' . pathinfo($filename, PATHINFO_FILENAME) . '.webp';
    imagewebp($dstImg, $webpPath, $quality);

    // Also save fallback file in original format
    if ($mime === 'image/jpeg') {
        imagejpeg($dstImg, $filePath, $quality);
    } elseif ($mime === 'image/png') {
        imagepng($dstImg, $filePath, 6);
    }

    imagedestroy($srcImg);
    imagedestroy($dstImg);

    clearstatcache();
    $origSize = filesize($backupPath);
    $newSize = filesize($filePath);
    $webpSize = file_exists($webpPath) ? filesize($webpPath) : 0;

    echo sprintf("%s (%dx%d -> %dx%d): Orig: %d KB | New: %d KB | WebP: %d KB (Saved %d%%)\n",
        $filename, $origW, $origH, $targetW, $targetH,
        round($origSize/1024), round($newSize/1024), round($webpSize/1024),
        round((1 - $webpSize/$origSize)*100)
    );
}

// Optimize Sliders (Max 1920x1080)
processImage('slider-1.jpg', 1920, 1080, 80);
processImage('slider-2.jpg', 1920, 1080, 80);
processImage('slider-3.jpg', 1920, 1080, 80);
processImage('slider-4.jpg', 1920, 1080, 80);
processImage('slider-5.jpg', 1920, 1080, 80);

// Optimize Gallery (Max 800x800)
processImage('gallery-1.png', 800, 800, 80);
processImage('gallery-2.png', 800, 800, 80);
processImage('gallery-3.png', 800, 800, 80);
processImage('gallery-4.png', 800, 800, 80);
processImage('gallery-5.png', 800, 800, 80);

// Optimize About
processImage('about.png', 800, 800, 80);

echo "Optimized all images successfully with WebP!\n";
