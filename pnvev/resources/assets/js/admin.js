// TinyMCE is imported manually in HTML (way too problematic to add via webpack)

const editor = tinymce.init({
  selector: "textarea#value",
  language: "es_MX",
  content_css: CONTENT_CSS,
  setup: (editor) => {
    editor.on("change", () => editor.save());
    editor.on("init", () => editor.setContent(EDITOR_INITIAL_CONTENT));
  },
  plugins: [
    "advlist",
    "autolink",
    "link",
    "lists",
    "charmap",
    "preview",
    "anchor",
    "pagebreak",
    "visualblocks",
    "visualchars",
    "fullscreen",
    "insertdatetime",
    "media",
    "table",
    "template",
    "help",
  ],
});
