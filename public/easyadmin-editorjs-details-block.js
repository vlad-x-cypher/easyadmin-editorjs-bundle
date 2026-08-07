class DetailsBlock {
    static get toolbox() {
        return {
            title: "Details",
            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect><line x1="2" y1="9" x2="22" y2="9"></line><circle cx="19" cy="6.5" r="0.5" fill="currentColor"></circle><line x1="6" y1="13" x2="14" y2="13" stroke-width="1.5"></line><line x1="6" y1="16" x2="18" y2="16" stroke-width="1.5"></line></svg>',
        }
    }
    constructor(t) {
        this.conf = t.config;
    
        this.data = t.data;
        this.innerEditor = null;

        /* @member {HTMLInputElement|null} */
        this.titleInput = null;
    }

    render() {
        const details = document.createElement('details');
        const summary = document.createElement('summary');
        const editorContainer = document.createElement('div');
        this.titleInput = document.createElement('input');
        this.titleInput.value = this.data && this.data.summary ? this.data.summary : "";
        editorContainer.style.padding = '1rem';
        editorContainer.style.border = '1px solid var(--form-input-border-color)';
        summary.style.border = '1px solid var(--form-input-border-color)';
        summary.style.padding = '4px';
        // Do not toggle on spacebar
        summary.onkeyup = (e) => {
            if(e.key == " ") {
                e.preventDefault();
            }
        };
        this.titleInput.style.width = '90%';

        summary.appendChild(this.titleInput);
        details.appendChild(summary);
        details.appendChild(editorContainer);
        // Stop event propogation to parent EditorJS instance.
        details.onkeyup = (e) => {
            e.stopPropagation();
        };
        details.onkeydown = (e) => {
            e.stopPropagation();
        };

        const cfg = {
            holder: editorContainer,
            data: this.data.data ?? {},
            tools: this.conf.tools,
        };

        Object.keys(cfg.tools).forEach(tool => {
          cfg.tools[tool].class = eval(cfg.tools[tool].class);
        });
        this.innerEditor = new EditorJS(cfg);
        return details;
    }

    async save(content) {
        if (!this.titleInput) {
            return null;
        }
        return {
            summary: this.titleInput.value,
            data: await this.innerEditor.save(),
        };
    }

}

