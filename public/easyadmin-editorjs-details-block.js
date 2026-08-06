class DetailsBlock {
    static get toolbox() {
        return {
            title: "Details",
            icon: '<svg width="17" height="15" viewBox="0 0 336 276" xmlns="http://www.w3.org/2000/svg"><path d="M291 150V79c0-19-15-34-34-34H79c-19 0-34 15-34 34v42l67-44 81 72 56-29 42 30zm0 52l-43-30-56 30-81-67-66 39v23c0 19 15 34 34 34h178c17 0 31-13 34-29zM79 0h178c44 0 79 35 79 79v118c0 44-35 79-79 79H79c-44 0-79-35-79-79V79C0 35 35 0 79 0z"/></svg>',
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
        this.titleInput.value = this.data && this.data.header ? this.data.header : "";
        editorContainer.style.padding = '1rem';
        editorContainer.style.border = '1px solid var(--form-input-border-color)';
        summary.style.border = '1px solid var(--form-input-border-color)';
        summary.style.padding = '4px';
        this.titleInput.style.width = '90%';

        summary.appendChild(this.titleInput);
        details.appendChild(summary);
        details.appendChild(editorContainer);

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
            header: this.titleInput.value,
            data: await this.innerEditor.save(),
        };
    }

}

