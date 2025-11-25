<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FileSystem
{
    /**
     * Save an uploaded image to the specified directory.
     *
     * @param \Illuminate\Http\UploadedFile $gambarFile The uploaded file instance.
     * @param string|null $fileName Custom file name (optional).
     * @param string $targetDir Target directory relative to the public path.
     * @return string|null Relative file path on success, or null if no file was provided.
     */
    public static function saveImage(\Illuminate\Http\UploadedFile $gambarFile, ?string $fileName = null, string $targetDir = 'storage'): ?string
    {
        $publicPath = public_path($targetDir);

        // Ensure the target directory exists
        if (!is_dir($publicPath) && !mkdir($publicPath, 0755, true) && !is_dir($publicPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $publicPath));
        }

        if ($gambarFile) {
            // Sanitize and generate a file name if not provided
            $fileName = $fileName
                ? Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '.' . $gambarFile->getClientOriginalExtension()
                : Str::uuid() . '.' . $gambarFile->getClientOriginalExtension();

            // Move the uploaded file to the specified directory
            $gambarFile->move($publicPath, $fileName);

            // Return the relative file path
            return $targetDir . '/' . $fileName;
        }

        return null; // Return null if no file was provided
    }
}
