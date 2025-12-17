<!doctype html>
<html lang="de">
    <head>
        <% base_tag %>
        $MetaTags(false)
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8">
        <title>PlaceholderPreview - $SiteConfig.Title</title>
        $ViteClient.RAW
        <link rel="stylesheet" href="$Vite("app/client/src/scss/main.scss")">
        <% include Atwx/Sck/SCKStylings %>
        <link rel="stylesheet" href="_resources/vendor/stevenpaw/silverstripe-styleguide/client/dist/assets/bundle.css">
        <script type="module" src="_resources/vendor/stevenpaw/silverstripe-styleguide/client/dist/bundle.js.js"></script>

        <link rel="manifest" href="site.webmanifest" />
    </head>
    <body class="placeholder-preview project-body">
        <!-- Sidebar Navigation -->
        <aside class="preview-sidebar">
            <div class="preview-sidebar__header">
                <h3>Preview Navigation</h3>
            </div>
            <nav class="preview-sidebar__nav">
                <ul class="preview-nav-list">
                </ul>
            </nav>
        </aside>

        <!-- Main Content with offset for sidebar -->
        <div class="preview-main-content">
            <div class="area_header">
                <% include Atwx/Sck/SCKHeader %>
            </div>
            <main class="area_content main">
                <!-- Typography -->
                <section class="section">
                    <div class="section_content">
                        <h1>Placeholder Preview</h1>
                    </div>
                </section>
                <section class="section section--preview" id="typography">
                    <div class="section_content">
                        <h1>Typography</h1>
                        <h2>Headline 2</h2>
                        <h3>Headline 3</h3>
                        <h4>Headline 4</h4>
                        <h5>Headline 5</h5>
                        <h6>Headline 6</h6>
                        <p>Paragraph</p>
                        <p><strong>Bold</strong></p>
                        <p><em>Italic</em></p>
                        <p><a href="#">Link</a></p>
                        <% include Atwx/Sck/Button Title="Primärer Button", URL="test.de" %>
                    </div>
                </section>

                <!-- TextImageElement -->
                <div class="section section--preview" id="textimage">
                    <div class="section_content">
                        <hr>
                        <h2>Text+Bild Elements</h2>
                    </div>
                </div>
                <% with $getPlaceholdersForElement("TextImageElement") %>
                    <% include Atwx/Sck/Elements/TextImageElement Title="Text+Bild (bild links)", ShowTitle=$ShowTitle, Text=$Text, Image=$PlaceholderImage %>
                <% end_with %>

                <% with $getPlaceholdersForElement("TextImageElement") %>
                    <% include Atwx/Sck/Elements/TextImageElement Title="Text+Bild (bild rechts)", ShowTitle=$ShowTitle, Text=$Text, Image=$PlaceholderImage, Variant="image--right" %>
                <% end_with %>

                <% with $getPlaceholdersForElement("TextImageElement") %>
                    <% include Atwx/Sck/Elements/TextImageElement Title="Text+Bild (Mit Allied Vision Maske)", ShowTitle=$ShowTitle, Text=$Text, Image=$PlaceholderImage, ImageMask="image--mask--alliedvision" %>
                <% end_with %>

                <% with $getPlaceholdersForElement("TextImageElement") %>
                    <% include Atwx/Sck/Elements/TextImageElement Title="Text+Bild (Mit Allied Vision Maske)", ShowTitle=$ShowTitle, Text=$Text, Image=$PlaceholderImage, ImageMask="image--mask--alliedvision", Variant="image--right", Button=$PlaceholderButton %>
                <% end_with %>

                <% with $getPlaceholdersForElement("TextImageElement") %>
                    <% include Atwx/Sck/Elements/TextImageElement Title="Text+Bild (Nur Text)", ShowTitle=$ShowTitle, Text=$Text, Variant="image--right" %>
                <% end_with %>
            </main>
        </div>
    </body>
</html>
