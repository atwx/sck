<div class="section section--GalleryElement gallerybackground--$BackgroundColor">
    <div class="section_content">
        <% if $ShowTitle %>
            <h2>$Title</h2>
        <% end_if %>
        <% if $Text %>
            $Text
        <% end_if %>
        <div class="gallery gallerysize--$ImageSize galleryformat--$ImageFormat">
            <% loop $PhotoGalleryImages %>
                <% if $Image %>
                    <% if $Up.ActivateLightbox %>
                        <a href="$Image.URL" class="gallery-item" data-gallery="gallery" data-glightbox="title: $Title" data-caption="$Title">
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
        </div>
    </div>
</div>
