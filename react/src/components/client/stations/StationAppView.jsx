import React, { useContext, useState } from "react";

const StationAppView = ({ viewData, openIssue }) => {
    
  return (
    <div className="bg-white p-4 rounded-lg shadow-md max-w-sm mx-auto">
        <div className="w-full bg-blue-500 text-center mb-8 rounded-md p-4">
        <p className="text-xl font-bold text-white">ONTIBIKES</p>
        </div>

        {viewData}

        <div className="text-center mt-4">
        <button className="text-blue-600 hover:text-blue-800 text-sm" onClick={openIssue}>
            ¿Problema con la estación?
        </button>
        </div>
    </div>
  );
};

export default StationAppView;
