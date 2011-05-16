# Distance formula based on
# http://zcentric.com/2010/03/11/calculate-distance-in-mysql-with-latitude-and-longitude/
CREATE FUNCTION DISTANCE(aLatitude FLOAT, aLongitude FLOAT, bLatitude FLOAT, bLongitude FLOAT)
RETURNS FLOAT DETERMINISTIC
RETURN ((ACOS(SIN(aLatitude * PI() / 180) * SIN(bLatitude * PI() / 180) + COS(aLatitude * PI() / 180) * COS(bLatitude * PI() / 180) * COS((aLongitude - bLongitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515);