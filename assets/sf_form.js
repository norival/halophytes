import DynamicElement from './js/classes/DynamicElement';

document.addEventListener('DOMContentLoaded', () => {
    const dynamicSpeciesElement = new DynamicElement(
        document.getElementById('new-species'),
        document.getElementById('species_feature_species')
    );
    dynamicSpeciesElement.start();

    const dynamicFeatureElement = new DynamicElement(
        document.getElementById('new-feature'),
        document.getElementById('species_feature_feature')
    );
    dynamicFeatureElement.start();

    const dynamicArticleElement = new DynamicElement(
        document.getElementById('new-article'),
        document.getElementById('species_feature_article')
    );
    dynamicArticleElement.start();
});
