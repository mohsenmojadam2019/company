# BYekan font

The UI is configured to prefer the locally installed `B Yekan` / `BYekan` font and then use system fallbacks.
For a production self-hosted font, place your properly licensed BYekan webfont in this directory and update the `@font-face` declaration in `resources/css/app.css`.
Do not load fonts from third-party CDNs; self-hosting is preferred for performance, privacy and Lighthouse stability.
