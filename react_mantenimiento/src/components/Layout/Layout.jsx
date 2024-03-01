import React, { Suspense } from 'react';
const Navbar = React.lazy(() => import('@/components/Navbar/Navbar'));

const Layout = ({ children }) => {
  return (
    <>
      <Suspense fallback={<div>Loading Navbar...</div>}>
        <Navbar />
      </Suspense>
      {children}
    </>
  );
};

export default Layout;
