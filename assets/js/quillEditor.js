export const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote', 'code-block'],
    ['link', 'image'],
    
    [{
        'header': 1
    }, {
        'header': 2
    }], // custom button values
    [{
        'list': 'ordered'
    }, {
        'list': 'bullet'
    }, {
        'list': 'check'
    }],
    [{
        'indent': '-1'
    }, {
        'indent': '+1'
    }], // outdent/indent
    
    ['clean'] // remove formatting button
];
export const quillOptions = {
    modules: {
        toolbar: toolbarOptions,
    },
    theme: 'snow'
};

    // Get the HTML content of the editor

    // For demonstration, we'll log the HTML content to the console

    // Example of sending it to a server (using Fetch API):
    /*
    fetch('/save-editor-content', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: htmlContent })
    }).then(response => response.json())
      .then(data => console.log('Success:', data))
      .catch(error => console.error('Error:', error));
    */

    // You could also save it to localStorage (for offline use)
    // localStorage.setItem('editorContent', htmlContent);

