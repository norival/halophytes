import DynamicElement from './js/classes/DynamicElement';
import Autocomplete from './js/classes/Autocomplete';

const DATA_TYPES = {
    'Qualitative data':  0,
    'Quantitative data': 1,
};

document.addEventListener('DOMContentLoaded', () => {
    const speciesAutocomplete = new Autocomplete(
        document.getElementById('species_feature_search_species'),
        document.getElementById('search-species-results'),
        document.getElementById('species_feature_species'),
        '/species/search'
    );

    const featureAutocomplete = new Autocomplete(
        document.getElementById('species_feature_search_feature'),
        document.getElementById('search-feature-results'),
        document.getElementById('species_feature_feature'),
        '/feature/search'
    );
    // const featureSearch = document.getElementById('species_feature_search_feature');
    // featureSearch.addEventListener('input', onKeyupFeatureSearch);
    // const dynamicSpeciesElement = new DynamicElement(
    //     document.querySelectorAll('[id^=species_feature_new_species_]'),
    //     [],
    //     document.getElementById('species_feature_species'),
    //     0,
    //     'change'
    // );
    // dynamicSpeciesElement.start();

    // const dynamicFeatureElement = new DynamicElement(
    //     document.getElementById('new-feature'),
    //     document.getElementById('species_feature_feature'),
    //     0,
    //     'change'
    // );
    // dynamicFeatureElement.start();

    // const dynamicArticleElement = new DynamicElement(
    //     document.getElementById('new-article'),
    //     document.getElementById('species_feature_article'),
    //     0,
    //     'change'
    // );
    // dynamicArticleElement.start();

    // const dynamicRangeElement = new DynamicElement(
    //     document.querySelectorAll('[id^=species_feature_value_]'),
    //     document.querySelectorAll('#species_feature_value'),
    //     document.getElementById('species_feature_range_value'),
    //     0,
    //     'click',
    //     true
    // );
    // dynamicRangeElement.start();
});
