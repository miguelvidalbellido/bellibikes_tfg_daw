import React from 'react';
import Html5QrcodePlugin from '@/components/client/qr/QrScan';

function qrScanner() {
  const onNewScanResult = (decodedText, decodedResult) => {
    // handle decoded results here
    console.log(`Scan result: ${decodedText}`, decodedResult);  
    alert(`Scan result: ${decodedText}`);
};

  return (
      <div className="Test">
          <Html5QrcodePlugin
              fps={10}
              qrbox={250}
              disableFlip={false}
              qrCodeSuccessCallback={onNewScanResult}
          />
      </div>
  );
  
}

export default qrScanner;
