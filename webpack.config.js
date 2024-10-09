const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// Common configurations for your assets
Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    // Add entry points
    .addEntry('app', './assets/app.js')
    .addEntry('stimulus', './assets/controllers/index.js') // Adjust this path according to your setup

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    // Clean up the output directory before each build
    .cleanupOutputBeforeBuild()

    // Enable build notifications
    .enableBuildNotifications()

    // Enable source maps
    .enableSourceMaps(!Encore.isProduction())

    // Enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // Configure Babel
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

// Uncomment if you use Sass/SCSS
//.enableSassLoader()

// Uncomment if you use TypeScript
//.enableTypeScriptLoader()

// Uncomment if you use React
//.enableReactPreset()

// Uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
//.enableIntegrityHashes(Encore.isProduction())

// Uncomment if you're having problems with a jQuery plugin
// .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
