<div class="section section--BranchesElement">
    <div class="section_content">
        <% if $ShowTitle && $Title %>
            <h2 class="branches-title">$Title</h2>
        <% end_if %>
        
        <% if $BranchItems %>
            <div class="branches-grid">
                <% loop $BranchItems %>
                    <div class="branch-item">
                        <% if $Image %>
                            <div class="branch-item-image">
                                $Image.ScaleWidth(1200)
                            </div>
                        <% end_if %>
                        
                        <div class="branch-item-content">
                            <% if $Title %>
                                <h3 class="branch-item-title">$Title</h3>
                            <% end_if %>
                            
                            <% if $Content %>
                                <div class="branch-item-text">
                                    $Content
                                </div>
                            <% end_if %>
                            
                            <% if $Button && $Button.exists() %>
                                <div class="branch-item-button">
                                    <% include Button Link=$Button %>
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                <% end_loop %>
            </div>
        <% end_if %>
    </div>
</div>
