function initilizeEditorJS() {
  Array.from(document.querySelectorAll('.editor-js-body')).forEach(el => {
    if(el.dataset.editorJsInitialized === "true") {
      return;
    }
    const cfg = {
        holder: `${el.id}-editor-js`,
    };
    if(el.value && el.value != "") {
      cfg.data = JSON.parse(el.value);
    }

    if(el.dataset.tools) {
        cfg.tools = JSON.parse(el.dataset.tools);
        Object.keys(cfg.tools).forEach(tool => {
          cfg.tools[tool].class = eval(cfg.tools[tool].class);
        });
    }

    const editor = new EditorJS(cfg);
    el.dataset.editorJsInitialized = "true";
    document.addEventListener('ea.form.submit', (e) => {
      editor
        .save()
        .then((json) => {
            el.value = JSON.stringify(json);
        })
        .catch((error) => {
            console.error("Saving failed: ", error);
        });
    });
  });
}

document.addEventListener('DOMContentLoaded', initilizeEditorJS);
document.addEventListener('ea.collection.item-added', initilizeEditorJS)
