<% with $News %>
    <div class="section section--News">
        <div class="section_content">
            <div class="section_backlink">
                <a href="javascript:history.back()" class="backlink_link" aria-label="Zurück zur Übersicht"><%t Back "« Zurück" %></a>
            </div>
            <div class="news_content">
                <div class="news_text">
                    <h1 class="news_title">$Title</h1>
                    <div class="news_datekat">$Date.Nice<% if $Category %> / $Category.Title<% end_if %></div>
                    <p class="news_content">$Content</p>
                    <% loop $Links %>
                        <div class="news_link">
                            <% include Atwx/Sck/Includes/Button Link=$Me %>
                        </div>
                    <% end_loop %>
                </div>                
                <% if $Image %>
                    <div class="news_image">
                        <a href="$Image.URL" class="glightbox" data-gallery="gallery" data-galleryid="$ID" aria-label="Bild öffnen: $Image.Title" data-singleimage="true">
                            $Image.ScaleWidth(400)
                        </a>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
<% end_with %>
