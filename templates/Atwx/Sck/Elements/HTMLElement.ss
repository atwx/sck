<section class="section section--HTMLElement">
    <div class="section_content">
        <% if $Title %>
            <h2 class="element-title">$Title</h2>
        <% end_if %>

        <div class="html-content">
            $HTMLContent.Raw
            <style>
                html > body {
                    font-family: var(--FontBody);
                }
            </style>
        </div>
    </div>
</section>
