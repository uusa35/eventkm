require('panolens.js');

const panoramaImagePath = 'asset/textures/equirectangular/field.jpg';
const panorama = new PANOLENS.ImagePanorama(panoramaImagePath);
const viewer = new PANOLENS.Viewer();
viewer.add( panorama );
