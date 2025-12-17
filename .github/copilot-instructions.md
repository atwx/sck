# Silverstripe Creator Kit (SCK) - AI Coding Instructions

## Project Overview
SCK is a SilverStripe 6 vendor module (`atwx/sck`) providing a comprehensive content management toolkit with Elemental blocks, custom styling, and multilingual support. It enables backend-driven website customization without touching code.

## Architecture & Key Dependencies

### Core Stack
- **Backend**: SilverStripe Framework 6 + Admin 3
- **Content Blocks**: dnadesign/silverstripe-elemental v6 (all elements extend `BaseElement`)
- **Multilingual**: tractorcow/silverstripe-fluent v8 (configured in `_config/fluent.yml`)
- **Frontend Build**: Vite 5 + Sass (outputs to `client/dist/`)
- **Dev Environment**: DDEV (Docker-based, see tasks for Xdebug)

### Module Structure
- `src/Elements/` - Elemental blocks (NewsElement, SliderElement, HTMLElement, etc.)
- `src/Admins/` - ModelAdmin classes for backend management (EventAdmin, NewsAdmin, etc.)
- `src/Extensions/` - DataExtension classes (PageExtension, CustomSiteConfig, Fluent extensions)
- `src/News/`, `src/Events/`, `src/People/` - Content models with relationships
- `templates/Atwx/Sck/` - SilverStripe `.ss` template files
- `client/src/` - Frontend source (Vite builds to `client/dist/`)

## Critical Development Workflows

### Building & Running
```bash
# Frontend assets (required after JS/SCSS changes)
ddev yarn build            # Production build
ddev yarn dev             # Development server on port 5173

# Code quality (run before committing)
ddev composer phpstan     # Static analysis (config: phpstan.neon.dist)
ddev composer phpcs       # PSR-12 code style (config: phpcs.xml.dist)
ddev composer phpunit     # Run tests
```

### Debugging
- **Xdebug**: Use VS Code tasks "DDEV: Enable/Disable Xdebug" (port 9003)
- **Path mapping**: `/var/www/html` → workspace root (see `.vscode/launch.json`)
- DDEV automatically handles Xdebug configuration

## SilverStripe Conventions Specific to This Project

### DataObject Patterns
1. **Table Names**: Always use `SCK_` prefix for Element table names
   ```php
   private static $table_name = 'SCK_NewsElement';
   ```

2. **Override Attribute**: Use `#[Override]` attribute for overridden methods (PHP 8.3+)
   ```php
   #[Override]
   public function getCMSFields() { /* ... */ }
   ```

3. **Field Labels**: Always provide German translations in `$field_labels`
   ```php
   private static $field_labels = [
       'Title' => 'Haupttitel',
       'HTMLContent' => 'HTML-Inhalt',
   ];
   ```

4. **Element Summary**: Implement `getSummary()` for GridField previews
   ```php
   public function getSummary(): string {
       return "Titel: " . $this->Title ?: "Element-Name";
   }
   ```

### Fluent (Multilingual) Integration
- **Extensions**: BaseElements use `BaseElementFluentExtension` (see `_config/fluent.yml`)
- **Translatable Fields**: Configure via `translate:` in YAML (Title, Content, etc.)
- **Links**: Use `LinkFluentCleanupExtension` for proper locale handling
- **Archive Behavior**: `FluentArchiveAllLocales` extension handles archiving across locales

### Element Development Pattern
All Elements follow this structure (see `HTMLElement.php` as reference):
1. Extend `DNADesign\Elemental\Models\BaseElement`
2. Define `$table_name` with `SCK_` prefix
3. Set `$icon` using font-icon classes
4. Enable `$inline_editable = true` for quick editing
5. Override `getType()` for German display name
6. Implement `getSummary()` for GridField preview
7. Use `provideBlockSchema()` for better CMS UX

## Frontend Architecture

### Build System (Vite)
- **Entry Points**: `client/src/bundles/bundle.js` and `client/src/styles/bundle.scss`
- **Output**: `client/dist/` (exposed via composer.json `extra.expose`)
- **Dev Server**: Runs on `0.0.0.0:5173` with hot reload
- **Source Maps**: Enabled for both JS and CSS

### JavaScript Libraries in Use
- **Swiper**: Image sliders (with effects: fade, coverflow, autoplay)
- **Embla Carousel**: Card sliders with custom arrow/dot controls
- **GLightbox**: Image galleries with touch/keyboard navigation
- **Motion**: Animation library (imported but usage TBD)
- **Flag Icons**: Language switcher flags

### JavaScript Initialization Pattern
All interactive components initialize in `client/src/boot/index.js`:
1. Wait for `DOMContentLoaded`
2. Query elements by `data-behaviour` attributes (e.g., `data-behaviour="embla"`)
3. Initialize with options, attach event handlers
4. Store instances for cleanup/reference

## Configuration & YAML Structure

### Extension Application (`_config/config.yml`)
- Extensions are applied to base classes (not individual elements)
- Use proper namespacing: `Atwx\Sck\Extensions\CustomSiteConfig`
- Gallery elements use `PhotoGalleryExtension` from purplespider/silverstripe-basic-gallery-extension

### Theme Hierarchy
```yaml
SilverStripe\View\SSViewer:
  themes:
    - '$default'
    - '$public'
    - 'depot'              # Project theme
    - 'silverstripe-elemental-suite-foundation-6'
```

## ModelAdmin Pattern
Simple ModelAdmin classes in `src/Admins/`:
```php
class EventAdmin extends ModelAdmin {
    private static $menu_title = 'Termine';  // German menu label
    private static $url_segment = 'events';   // Admin URL
    private static $menu_icon_class = 'font-icon-calendar';
    private static $managed_models = [Event::class];
}
```

## Integration Points

### Template Integration Options
Two methods for consuming SCK (documented in README):

1. **Full Replacement**: Replace entire Page.ss layout
   ```ss
   <% include Atwx/Sck/Includes/SCKPage Layout=$Layout %>
   ```

2. **Partial Integration**: Import specific components
   ```ss
   <% include Atwx/Sck/Includes/SCKStylings %>  <%-- CSS + JS --%>
   <% include Atwx/Sck/Includes/SCKHeader %>
   <% include Atwx/Sck/Includes/SCKFooter %>
   ```

### Asset Exposure
Frontend assets are exposed via `composer.json`:
```json
"extra": {
    "expose": ["client/dist"]
}
```
This maps to `_resources/vendor/atwx/sck/client/dist/` in web root.

## Common Pitfalls & Solutions

1. **Namespace Confusion**: Extensions in `_config/fluent.yml` use `App\Extensions\` but source is in `Atwx\Sck\Extensions\` - check actual class namespaces
2. **Fluent RecordLocales**: Hidden via `updateCMSFields` in `BaseElementFluentExtension` for cleaner CMS
3. **Asset Extensions**: SVG support added via `SilverStripe\Assets\File::allowed_extensions`
4. **Build Output**: Always run `ddev yarn build` before testing frontend changes in production mode

## Testing Approach
- PHPUnit config: `phpunit.xml.dist` (framework integration tests)
- No visible test files yet - follow SilverStripe test conventions when adding
- Run via `ddev composer phpunit`
