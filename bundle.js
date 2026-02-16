const fs = require('fs');
const path = require('path');
const archiver = require('archiver');

// Create dist folder if it doesn't exist
const distDir = path.join(process.cwd(), 'dist');
if (!fs.existsSync(distDir)) {
  fs.mkdirSync(distDir, { recursive: true });
  console.log('✓ Created dist directory\n');
}

// Output filename - fixed name as requested
const themeName = 'sagicarmi-theme';
const outputFile = path.join(distDir, `${themeName}.zip`);
const output = fs.createWriteStream(outputFile);
const archive = archiver('zip', {
  zlib: { level: 9 } // Maximum compression
});

// Listen for archive events
output.on('close', () => {
  console.log(`\n✓ Bundle created: ${path.relative(process.cwd(), outputFile)}`);
  console.log(`✓ Total size: ${(archive.pointer() / 1024 / 1024).toFixed(2)} MB`);
});

archive.on('error', (err) => {
  throw err;
});

archive.on('warning', (err) => {
  if (err.code === 'ENOENT') {
    console.warn('Warning:', err);
  } else {
    throw err;
  }
});

// Pipe archive to output file
archive.pipe(output);

console.log('Creating WordPress theme bundle...\n');

// Files and directories to exclude
const excludePatterns = [
  'node_modules/**',
  '.git/**',
  '.gitignore',
  '.github/**',
  'dist/**', // Exclude the output directory
  'package.json',
  'tailwind.config.js',
  'README.md',
  'phpcs.xml.dist',
  'package-lock.json',
  'composer.lock',
  'composer.json',
  'vendor',
  '.DS_Store',
  '.eslintrc',
  '.stylelintrc.json',
  'bundle.js', // Exclude this build script itself
  'assets/css/tailwind.css', // User requested exclusion
  '.vscode/**',
];

// Include all files except excluded ones
archive.glob('**/*', {
  ignore: excludePatterns,
  dot: true // Include hidden files like .htaccess if needed
});

// Finalize the archive
archive.finalize();

console.log('\nExcluded patterns:');
excludePatterns.forEach(pattern => console.log(`  - ${pattern}`));
console.log('\nBundling...');