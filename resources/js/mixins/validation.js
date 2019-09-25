
export function imgValid(value) {
    console.log(value)
    return /\.(jpe?g|png|gif|jpg|svg)$/i.test(value) == false;
}