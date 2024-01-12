function getRed(hex) {
    return parseInt(hex.substring(1, 3), 16);
  }
  
  function getGreen(hex) {
    return parseInt(hex.substring(3, 5), 16);
  }
  
  function getBlue(hex) {
    return parseInt(hex.substring(5, 7), 16);
  }
