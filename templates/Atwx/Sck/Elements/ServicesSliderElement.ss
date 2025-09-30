<div class="services-slider-element">
    <div class="container">
        <% if $SliderTitle %>
        <h2 class="slider-title">$SliderTitle</h2>
        <% end_if %>
        
        <div class="services-slider-wrapper">
            <div class="services-slider" 
                 data-autoplay="$Autoplay" 
                 data-autoplay-speed="$AutoplaySpeed"
                 data-show-dots="$ShowDots"
                 data-show-arrows="$ShowArrows">
                
                <% if $ServiceSlides %>
                    <% loop $ServiceSlides %>
                    <div class="service-slide">
                        <% if $BackgroundImage %>
                        <div class="service-slide-image">
                            <img src="$BackgroundImage.AbsoluteURL" alt="$Title" loading="lazy">
                            <div class="service-slide-overlay"></div>
                        </div>
                        <% end_if %>
                        
                        <div class="service-slide-content">
                            <% if $Title %>
                            <h3 class="service-slide-title">$Title</h3>
                            <% end_if %>
                            
                            <% if $Content %>
                            <div class="service-slide-text">
                                <p>$Content</p>
                            </div>
                            <% end_if %>
                            
                            <% if $ButtonLink && $ButtonText %>
                            <div class="service-slide-button">
                                <a href="$ButtonLink.URL" class="btn btn-service" 
                                   <% if $ButtonLink.OpenInNew %>target="_blank"<% end_if %>>
                                    $ButtonText
                                </a>
                            </div>
                            <% end_if %>
                        </div>
                    </div>
                    <% end_loop %>
                <% else %>
                    <div class="service-slide service-slide-placeholder">
                        <div class="service-slide-content">
                            <h3>Noch keine Service-Kacheln</h3>
                            <p>Fügen Sie Service-Kacheln über das Backend hinzu.</p>
                        </div>
                    </div>
                <% end_if %>
            </div>
            
            <% if $ShowArrows %>
            <div class="slider-arrows">
                <button class="slider-arrow slider-arrow-prev" data-direction="prev">
                    <span>‹</span>
                </button>
                <button class="slider-arrow slider-arrow-next" data-direction="next">
                    <span>›</span>
                </button>
            </div>
            <% end_if %>
            
            <% if $ShowDots && $ServiceSlides.Count > 1 %>
            <div class="slider-dots">
                <% loop $ServiceSlides %>
                <button class="slider-dot<% if $IsFirst %> active<% end_if %>" data-slide="$Pos"></button>
                <% end_loop %>
            </div>
            <% end_if %>
        </div>
    </div>
</div>
