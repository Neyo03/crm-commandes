import './bootstrap.js';
import '../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';
import '../node_modules/bootstrap/dist/css/bootstrap.min.css';
import '../node_modules/bootstrap-icons/font/bootstrap-icons.min.css';
import './styles/app.css';

$("select").selectize({
    plugins: ["restore_on_backspace", "clear_button"],
    delimiter: " - ",
    persist: true,
    maxItems: null,
    valueField: "name",
    labelField: "name",
    searchField: ["name"],
  });


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
