var config = {
  '.custom-select'           : {},
  '.custom-select-deselect'  : { allow_single_deselect: true },
  '.custom-select-no-single' : { disable_search_threshold: 10 },
  '.custom-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.custom-select-rtl'       : { rtl: true },
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
