export const chartTitleStyle = {
    color: 'black',
};

export const chartCaptionStyle = {
    color: 'black',
}

export const chartYTitleStyle = {
    color: 'black',
};

export const chartXTitleStyle = {
    color: 'black',
};

export const chartXLabelStyle = {
    color: 'black',
};

export const epiweeks = function (){
    let epiweeks = [];
    for (let i = 1; i < 53; ++i)
        epiweeks.push(i);
    // console.log(epiweeks);
    return epiweeks;
}();