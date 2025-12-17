<section class="section section--HTMLElement">
    <div class="section_content">
        <% if $Title %>
            <h2 class="element-title">$Title</h2>
        <% end_if %>

        <div class="html-content">
            $HTMLContent.Raw
        </div>
    </div>
</section>
