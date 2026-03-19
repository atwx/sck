<section class="section--GalleryElement $BackgroundColor">
    <div class="section_content animation--$FadeInAnimation $ElementDecoration">
        <% if $ShowTitle %>
            <% if $UseH1ForTitle %>
                <h1 class="hl1">$Title</h1>
            <% else %>
                <h2 class="hl2">$Title</h2>
            <% end_if %>
        <% end_if %>
        <% if $Text %>
            $Text
        <% end_if %>
        <div class="gallery gallerysize--$ImageSize galleryformat--$ImageFormat">
            <% loop $PhotoGalleryImages %>
                <% if $Image %>
                    <% if $Up.ActivateLightbox %>
                        <a href="$Image.URL" class="glightbox gallery-item" data-gallery="gallery" data-glightbox="title: $Title" data-caption="$Title" data-galleryid="$Up.ID">
                            <% if $Up.ImageFormat == "square" %>
                                $Image.FocusFillMax(400, 400)
                            <% else_if $Up.ImageFormat == "rectangle" %>
                                $Image.FocusFillMax(800, 400)
                            <% else %>
                                $Image.FitMax(800, 800)
                            <% end_if %>
                            <% if $Title %>
                                <h3>$Title</h3>
                            <% end_if %>
                            <% if $Image.Description %>
                                <p>$Image.Description</p>
                            <% end_if %>
                        </a>
                    <% else %>
                        <div class="gallery-item">
                            <% if $Up.ImageFormat == "square" %>
                                $Image.FocusFillMax(400, 400)
                            <% else_if $Up.ImageFormat == "rectangle" %>
                                $Image.FocusFillMax(800, 400)
                            <% else %>
                                $Image.FitMax(800, 800)
                            <% end_if %>
                            <% if $Title %>
                                <h3>$Title</h3>
                            <% end_if %>
                            <% if $Image.Description %>
                                <p>$Image.Description</p>
                            <% end_if %>
                        </div>
                    <% end_if %>
                <% end_if %>
            <% end_loop %>
            <% loop $GalleryVideos %>
                <% if $VideoID %>
                    <% if $Up.ActivateLightbox %>
                        <a href="$EmbedURL" class="glightbox gallery-item gallery-item--video" data-gallery="gallery" data-type="video" data-galleryid="$Up.ID"<% if $Title %> data-glightbox="title: $Title"<% end_if %>>
                            <img src="$ThumbnailURL" alt="$Title" loading="lazy">
                            <% if $Title %>
                                <h3 class="video-title">$Title</h3>
                            <% end_if %>
                        </a>
                    <% else %>
                        <div class="gallery-item gallery-item--video">
                            <iframe width="1920" height="1080" src="https://www.youtube-nocookie.com/embed/$VideoID" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <% if $Title %>
                                <h3 class="video-title">$Title</h3>
                            <% end_if %>
                        </div>
                    <% end_if %>
                <% end_if %>
            <% end_loop %>
        </div>
    </div>
</section>
