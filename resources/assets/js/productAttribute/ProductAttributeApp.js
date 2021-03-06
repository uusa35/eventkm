import React, {useState, useEffect, useMemo} from 'react'
import {trans} from "./trans";
import axios from 'axios';
import {filter, first, map, uniqBy, isEmpty, isNull} from 'lodash'
import $ from 'jquery'

const ProductAttributeApp = () => {
    const [lang, setLang] = useState($('#appLang').val())
    const [productId, setProductId] = useState($(`#product_id`).val())
    const [currentLang, setCurrentLang] = useState(trans(lang));
    const [attributes, setAttributes] = useState([]);
    const [colors, setColors] = useState([]);
    const [sizes, setSizes] = useState([]);
    const [currentAttribute, setCurrentAttribute] = useState([]);
    const [currentColor, setCurrentColor] = useState(null);
    const [currentSize, setCurrentSize] = useState(null)
    const [colorDisabled, setColorDisabled] = useState(true);

    useEffect(() => {
        $(document).ready(() => {
            axios.post(`/api/attributes`, {product_id: productId})
                .then(r => {
                    setAttributes(r.data)
                    $(`#add_to_cart_${productId}`).attr('disabled', 'disabled');
                })
                .catch(e => console.log('e', e))
        })
    }, [])

    useMemo(() => {
        if (!isEmpty(attributes)) {
            const colors = map(uniqBy(attributes, 'color.id'), 'color');
            const sizes = map(uniqBy(attributes, 'size.id'), 'size');
            setColors(colors);
            setSizes(sizes);
        }
    }, [attributes])

    const handleSizeClick = (id) => {
        setCurrentSize(id)
        setCurrentAttribute(null)
        setCurrentColor(null)
    }

    useMemo(() => {
        if (!isNull(currentSize)) {
            const filteredAttributes = filter(attributes, (a => a.size.id === currentSize))
            const filteredColors = map(filteredAttributes, 'color');
            setColors(filteredColors);
            $(`#size_id_${productId}`).attr('value', currentSize);
            $('#alertCartMessage').removeClass('d-none');
        }
    }, [currentSize])

    const handleColorClick = (id) => {
        setCurrentColor(id)
        setColorDisabled(false);
        const attribute = first(filter(attributes, (a => a.color.id === id && a.size.id === currentSize)));
        setCurrentAttribute(attribute)
    }

    useMemo(() => {
        if (!isEmpty(currentAttribute)) {
            const {color, qty} = currentAttribute;
            $(`#color_id_${productId}`).attr('value', color.id);
            // const newQty = sum([$`#qty_${productId}`).getAttribute('value'),1]);
            $(`#qty_${productId}`).attr('value', 1);
            $(`#product_attribute_id_${productId}`).attr('value', currentAttribute.id);
            $(`#max-qty-${productId}`).attr('size', qty);
            $(`#max-qty-${productId}`).attr('value', 1);
            $(`#max-qty-${productId}`).attr('placeholder', 1);
            $(`#minus-btn-${productId}`).removeAttr('disabled');
            $(`#plus-btn-${productId}`).removeAttr('disabled');
            $(`#add_to_cart_${productId}`).removeAttr('disabled');
        } else {
            $(`#color_id_${productId}`).attr('value', null);
            $(`#qty_${productId}`).attr('value', 0);
            $(`#max-qty-${productId}`).removeAttr('size');
            $(`#max-qty-${productId}`).attr('placeholder', 1);
            $(`#max-qty-${productId}`).attr('value', 1);
            $(`#product_attribute_id_${productId}`).attr('value', null)
            $(`#add_to_cart_${productId}`).attr('disabled', 'disabled');
            $(`#minus-btn-${productId}`).attr('disabled', 'disabled');
            $(`#plus-btn-${productId}`).attr('disabled', 'disabled');
        }
        $(`#max-qty-${productId}`).val('1');
    }, [currentAttribute, currentColor, currentSize])

    return (
        <div className="tt-swatches-container">
            <div className="tt-wrapper">
                <div className="tt-title-options">{currentLang.size}</div>
                <ul className="tt-options-swatch options-large">
                    {
                        map(sizes, (s, i) =>
                            <li key={i} className={`${currentSize === s.id ? 'active' : ''}`}>
                                <a style={{minWidth: 80}}
                                   onClick={() => handleSizeClick(s.id)}><strong>{s.name}</strong>
                                </a>
                            </li>
                        )
                    }
                </ul>
            </div>
            <div className="tt-wrapper">
                <div className="tt-title-options">{currentLang.choose_color}:</div>
                <ul className="tt-options-swatch options-large">
                    {
                        map(colors, (c, i) => (
                            <li key={i}
                                className={`${currentColor === c.id ? 'active' : ''}`}>
                                <a
                                    disabled={colorDisabled} className="options-color tooltip"
                                    data-tooltip={`${currentSize ? currentLang.chooseSizeThenColor : ''}`}
                                    onClick={(e) => handleColorClick(c.id)} style={{backgroundColor: c.code}}></a>
                            </li>
                        ))
                    }
                </ul>
            </div>
        </div>

    );
}

export default ProductAttributeApp;
