<?php
/**
 * Temporary file to create storage link
 * After running this file ONCE, delete it immediately for security!
 *
 * Usage:
 * 1. Upload this file to your live server: public/storage-link.php
 * 2. Visit: http://your-domain.com/storage-link.php in browser
 * 3. Delete this file immediately after seeing success message
 */

// Get the project root directory
$projectRoot = dirname(__DIR__);

// Define paths
$targetPath = $projectRoot . '/storage/app/public';
$linkPath = $projectRoot . '/public/storage';

// Check if link already exists
if (file_exists($linkPath)) {
    if (is_link($linkPath)) {
        echo "✓ Storage link already exists!<br>";
        echo "Link: $linkPath<br>";
        echo "Points to: " . readlink($linkPath) . "<br><br>";
        echo "Images should now be working. Please delete this file (storage-link.php) immediately!";
    } else {
        echo "✗ Error: $linkPath exists but is not a symbolic link.<br>";
        echo "Please delete it manually first, then run this script again.";
    }
    exit;
}

// Check if target directory exists
if (!is_dir($targetPath)) {
    echo "✗ Error: Storage directory does not exist: $targetPath<br>";
    echo "Please create it first.";
    exit;
}

// Try to create the symbolic link
try {
    if (symlink($targetPath, $linkPath)) {
        echo "✓ Success! Storage link created successfully!<br><br>";
        echo "Link: $linkPath<br>";
        echo "Points to: $targetPath<br><br>";
        echo "Images should now be working. Please delete this file (storage-link.php) immediately for security!<br><br>";
        echo "<strong style='color: red;'>⚠️ IMPORTANT: Delete this file now!</strong>";
    } else {
        echo "✗ Error: Failed to create symbolic link.<br>";
        echo "This might be a permissions issue. Please contact your hosting provider or use SSH to run: php artisan storage:link";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "<br>";
    echo "Please use SSH to run: php artisan storage:link";
}

