import 'summernote/dist/summernote-lite.css';
import 'summernote/dist/summernote-lite.js';

class SummernoteEditor {
    constructor(selector, options = {}) {
        this.selector = selector;

        this.defaultOptions = {
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen']]
            ],
        };
        this.options = { ...this.defaultOptions, ...options };
        this.init();
    }

    init() {
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is required for Summernote');
            return;
        }

        $(this.selector).summernote(this.options);
    }

    // Get editor content
    getContent() {
        return $(this.selector).summernote('code');
    }

    // Set editor content
    setContent(content) {
        $(this.selector).summernote('code', content);
    }

    // Destroy editor
    destroy() {
        $(this.selector).summernote('destroy');
    }
}

export { SummernoteEditor };