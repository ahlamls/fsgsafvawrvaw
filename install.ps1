# Specify the WordPress version you want to fetch
$WP_VERSION = "latest"

# Specify your project directory
#$PROJECT_DIR = "C:\path\to\your\project"

# Navigate to the project directory
#Set-Location -Path $PROJECT_DIR

# Fetch the WordPress core
Invoke-WebRequest -Uri ("https://wordpress.org/wordpress-$WP_VERSION.tar.gz") -OutFile ("wordpress-$WP_VERSION.tar.gz")

# Unzip the WordPress core
Expand-Archive -Path "wordpress-$WP_VERSION.tar.gz" -DestinationPath .

# Create directories if they don't exist
New-Item -Path ".\wp-includes" -ItemType Directory -Force
New-Item -Path ".\wp-admin" -ItemType Directory -Force

# Copy core files to the project root
Copy-Item -Path ".\wordpress\wp-includes\*" -Destination ".\wp-includes" -Recurse -Force
Copy-Item -Path ".\wordpress\wp-admin\*" -Destination ".\wp-admin" -Recurse -Force

# Clean up
Remove-Item -Path ".\wordpress" -Recurse -Force
Remove-Item -Path "wordpress-$WP_VERSION.tar.gz" -Force

# Rename wp-config.php
#Rename-Item -Path ".\wp-config-sample.php" -NewName "wp-config.php"

# Generate unique salts and replace them in wp-config.php
#$SALTS = Invoke-RestMethod -Uri "https://api.wordpress.org/secret-key/1.1/salt/"
#(Get-Content -Path ".\wp-config.php") -replace "put your unique phrase here", $SALTS | Set-Content -Path ".\wp-config.php"

Write-Host "WordPress wp-includes and wp-admin folders copied, wp-config.php set up!"
