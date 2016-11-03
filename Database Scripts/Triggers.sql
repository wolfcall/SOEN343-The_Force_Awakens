Drop trigger if exists check_waitlist;

Delimiter $$
create trigger soen343.check_waitlist after delete on reservation
for each row 
	
Begin
	
    Insert into  reservation 
		/*Select wl.* from waitlist as wl;
        /*Where wl.roomID = OLD.room
		and wl.startTimeDate = OLD.startTimeDate
		and wl.endTimeDate = OLD.endTimeDate ;*/
        (Select studentID, roomID, startTimeDate, endTimeDate, title, description fROM 
			(Select waitlistID, studentID, roomID, startTimeDate, endTimeDate, title, description from waitlist as wl
					Where roomID = OLD.roomID
					and startTimeDate = OLD.startTimeDate
					and endTimeDate = Old.endTimeDate) as T1
			where roomID = min(roomID));
                    
	Delete from waitlist
    where  roomID = OLD.roomID
			and startTimeDate = OLD.startTimeDate
			and endTimeDate = Old.endTimeDate;
end;


/*(Select studentID, roomID, startTimeDate, endTimeDate, title, description fROM 
(Select waitlistID, roomID, startTimeDate, endTimeDate, title, description from waitlist
					Where roomID = OLD.room
					and startTimeDate = OLD.startTimeDate
					and endTimeDate = Old.endTimeDate)
                    where waitlistID = min(waitlistID));*/