import React, { Suspense } from 'react';
const Stats = React.lazy(() => import('@/components/Stats/Stats'))
const Home = () => {
  return (
    <Suspense fallback={<div>Loading...</div>}>
      
      <Stats />
    </Suspense>
  );
};

export default Home;
